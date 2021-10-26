function currencyFormat(value) {
    return currency(value, {symbol: '', separator: ',', decimal: '.', fromCents: false, precision: 2}).format();
}

function numberFormat(value) {
    return currency(value, {symbol: '', separator: ',', precision: 0}).format();
}
