function number_format(number, decimals, dec_point, thousands_sep) { 
  var i, j, kw, kd, km
 
  if (isNaN((decimals = Math.abs(decimals)))) {
    decimals = 2
  }
  if (dec_point == undefined) {
    dec_point = ','
  }
  if (thousands_sep == undefined) {
    thousands_sep = '.'
  }

  i = parseInt((number = (+number || 0).toFixed(decimals))) + ''

  if ((j = i.length) > 3) {
    j = j % 3
  } else {
    j = 0
  }

  km = j ? i.substr(0, j) + thousands_sep : ''
  kw = i.substr(j).replace(/(\d{3})(?=\d)/g, '$1' + thousands_sep)
  
  kd = decimals
    ? dec_point +
      Math.abs(number - i)
        .toFixed(decimals)
        .replace(/-/, 0)
        .slice(2)
    : ''

  return km + kw + kd
}

function priceFormat(price) {
  return number_format(price, 0, '.', ' ')
}

function labelFormat(number, titles) {
  let cases = [2, 0, 1, 1, 1, 2]
  return titles[
    number % 100 > 4 && number % 100 < 20
      ? 2
      : cases[number % 10 < 5 ? number % 10 : 5]
  ]
}

export { number_format, priceFormat, labelFormat }
