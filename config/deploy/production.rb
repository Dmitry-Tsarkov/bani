role :app, %w{www-root@188.120.253.163}

set :application, 'dom-sruba.ru'
set :deploy_to, -> { "/var/www/www-root/data/www/#{fetch(:application)}" }
set :linked_dirs, %w{app/web/uploads app/runtime}
set :linked_files, %w{app/composer.phar app/.env  frontend/static/sitemap.xml frontend/static/robots.txt frontend/.env}
set :keep_releases, 1

set :tmp_dir, "/var/www/www-root/data/temp"

set :composer_install_flags, '--no-dev'
set :composer_roles, :all
set :composer_working_dir, -> { "#{fetch(:release_path)}/app" }
set :composer_dump_autoload_flags, '--optimize'
set :composer_download_url, "https://getcomposer.org/installer"
set :composer_version, '2.1.3'
SSHKit.config.command_map[:composer] = "/opt/php71/bin/php #{shared_path.join("app/composer.phar")}"

namespace :deploy do
    after :starting, 'composer:install_executable'
    before 'deploy:symlink:release', 'deploy:npm_build'
    after :deploy, 'deploy:apply_migrations'
    #after :deploy, 'deploy:seeder_refresh'
    after :deploy, 'deploy:restart_nuxt'

     task :seeder_refresh do
        on roles(:app) do
            execute "cd #{current_path}/app && /opt/php71/bin/php yii seeder/seeder/refresh"
            info "Apply migrations"
        end
    end

    task :apply_migrations do
        on roles(:app) do
            execute "cd #{current_path}/app && /opt/php71/bin/php yii migrate --interactive=0"
            info "Apply migrations"
        end
    end

    task :restart_nuxt do
        on roles(:app) do
           execute "supervisorctl restart dom_sruba_nuxt"
        end
    end

    task :npm_build do
        on roles(:app) do
            execute "cd #{release_path}/frontend && npm i && npm run build"
            info "nuxt built"
        end
    end
end
