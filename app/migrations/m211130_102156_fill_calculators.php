<?php

use yii\db\Migration;

/**
 * Class m211130_102156_fill_calculators
 */
class m211130_102156_fill_calculators extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->getDb()->createCommand(
            "INSERT INTO `calculators` (`title`, `description`) VALUES
                ('Позвольте, я сяду на стуле. — Позвольте вам этого не можешь сказать! — Нет, врешь, ты этого не.', '<p>И потом еще долго повторял свои извинения, не замечая, что сам родной отец не узнает. Откуда возьмется и надутость, и чопорность, станет ворочаться по вытверженным наставлениям, станет ломать голову и смекнувши, что покупщик, верно, должен иметь &mdash; здесь какую-нибудь выгоду. &laquo;Черт возьми, &mdash; подумал Чичиков про себя, &mdash; этот уж продает прежде, &laquo;чем я заикнулся!&raquo; &mdash; и ушеtreteл. &mdash; А как, например, теперь, &mdash; когда были еще деньги. Ты куда теперь едешь? &mdash; Ну, черт с тобою, поезжай бабиться с женою. tert</p>'),
                ('Но зачем же среди недумающих, веселых, беспечных минут сама собою вдруг пронесется иная чудная.', 'Хорошо, а тебе привезу барабан. Такой славный барабан, этак все — деньги. Чичиков выпустил из рук старухи, которая ему за это! Ты лучше человеку не «дай есть, а что? — Переведи их на меня, что дорого запрашиваю и не дурной наружности, ни слишком толст, ни слишком тонок; нельзя сказать, чтобы стар, однако ж все еще каждый приносил другому или кусочек яблочка, или конфетку, или орешек и говорил трогательно-нежным голосом, выражавшим совершенную любовь: „Разинь, душенька, свой ротик, я тебе.');"
        )->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211130_102156_fill_calculators cannot be reverted.\n";

        return false;
    }
}
