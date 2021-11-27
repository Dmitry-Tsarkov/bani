function getError(error) {
  if (error.response.status == 422) {
    return ''
  }
  if (error.response && error.response.data.message) {
    return error.response.data.message
  }

  return 'Техническая ошибка.'
}

function getErrors(error) {
  if (error.response.status == 422) {
    return error.response.data.errors
  }
  return {}
}

export { getError, getErrors }
