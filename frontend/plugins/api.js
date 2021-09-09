export default ({ app }, inject) => {
  const api = {
    get(uri, params, cancelToken) {
      return app.$axios.$get(this.getUrl(uri), { params, cancelToken})
    },
    post(uri, data) {
      return app.$axios.$post(this.getUrl(uri), data)
    },
    load(uri, params) {
      return this.get(uri, params).then((response) => {
        return {
          data: response,
        }
      })
    },
    getUrl(uri) {
      return '/api/' + this.trimChar(uri, '/')
    },
    trimChar(string, charToRemove) {
      while (string.charAt(0) == charToRemove) {
        string = string.substring(1)
      }

      while (string.charAt(string.length - 1) == charToRemove) {
        string = string.substring(0, string.length - 1)
      }

      return string
    },
  }
  inject('api', api)
}
