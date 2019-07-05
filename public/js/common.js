function formatDateTime(expiration) {
    const jsDateTime = new Date(parseInt(expiration) * 1000);
    return jsDateTime.getFullYear()
        + '-' + ((jsDateTime.getMonth() + 1) + '').padStart(2, '0')
        + '-' + (jsDateTime.getDate() + '').padStart(2, '0')
        + ' ' + (jsDateTime.getHours() + '').padStart(2, '0')
        + ':' + (jsDateTime.getMinutes() + '').padStart(2, '0')
        + ':' + (jsDateTime.getSeconds() + '').padStart(2, '0');
}

function isUnlimited(expiration) {
    isUnLim = parseInt(expiration) === 1000 * 12 * 30 * 24 * 60 * 60;
    return isUnLim;
}

const settings={
    noLimits:"без ограничения"
};
