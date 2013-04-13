function IsEmpty(sInString) {
    if (sInString == null || sInString == undefined) {
        return true;
    }
    return !(sInString.match(/\S/));
}

function trim(sInString) {
    if ((sInString == null) || (sInString.length == 0)) {
        return '';
    }
    return sInString.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
}

function validateEmail(str) {
    str = str.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
    return (/^([a-z0-9_\-]+\.)*[a-z0-9_\-]+@([a-z0-9][a-z0-9_\-]*\.)+[a-z]{2,4}$/i).test(str);
}

function IsNumeric(str) {
    str = str.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
    Ex = /^(\d|[1-9]\d*)$/
    return Ex.test(str);
}
