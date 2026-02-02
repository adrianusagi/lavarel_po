function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which:event.keyCode
    if(charCode >31 && (charCode<48 || charCode>57)) return false; return true;
};
function urldecode(url){
    if(typeof url == 'undefined') return false;
    return decodeURIComponent(url.replace(/\+/g, ' '));
}
function urlencode(url){
    return encodeURIComponent(url);
}
function date_jsToMysql(_date){
	return _date.getFullYear()+'-'+(_date.getMonth()+1)+'-'+_date.getDate();
}
function datetime_jsToMysql(_date){
    return _date.getFullYear()+'-'+(_date.getMonth()+1)+'-'+_date.getDate()+' '+_date.getHours()+':'+_date.getMinutes()+':'+_date.getSeconds();
}
function date_jsFromMysql(stringdate){
    var _date = new Date();
    _str = stringdate.split('-');
    _date.setFullYear(_str[0]);
    _date.setMonth(parseInt(_str[1])-1);
    _date.setDate(_str[2]);
    return _date;
}
function datetime_jsFromMysql(stringdate){
    if(stringdate.length==0) return null;
    var _date = new Date();
    _strdate = stringdate.split(' ');
    _str = _strdate[0].split('-');
    _date.setFullYear(_str[0]);
    _date.setMonth(parseInt(_str[1])-1);
    _date.setDate(_str[2]);

    _str = _strdate[1].split(':');
    _date.setHours(_str[0]);
    _date.setMinutes(_str[1]);
    _date.setSeconds(_str[2]);
    return _date;
}
function object_merge(obj1,obj2){
    var result={};
    $.extend(result, obj1, obj2);
    return result;
}
function in_array(needle, haystack){
    var length = haystack.length;
    for(var i = 0; i < length; i++) {
        if(typeof haystack[i] == 'object') {
            if(arrayCompare(haystack[i], needle)) return true;
        } else {
            if(haystack[i] == needle) return true;
        }
    }
    return false;
}
function is_validEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}
function is_validJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}
function uniqid(prefix = ''){
    const sec = Math.floor(Date.now() / 1000).toString(16);
    const msec = (Date.now() % 1000).toString(16).padStart(3, '0');
    const random = Math.random().toString(16).substring(2, 8);
    
    return prefix + sec + msec + random;
}
function number_to_currency(number,symbol='Rp'){
    if(number==null) return "Rp -";
    return symbol+number.toString().replace(/\B(?=(\d{3})+(?!\d))/g,".");
}
function redirect(url){
    window.location.href = url;
}
function htmlGetAllAttr($elm){
    var result = {};
    $.each($elm[0].attributes, function(){
        if(this.specified){
        result[this.name] = this.value;
        }
    })
    return result;
}
function isStrContain(str,chr){
    return str.includes(chr);
}
function number_short_postfix(number){
    if(number > 1000000){
        let _num = number / 1000000;
        return _num.toFixed(2)+'M';
    } else if(number > 1000){
        let _num = number / 1000;
        return Math.round(_num)+'K';
    } else return number;
}

var toasts = {};

function bootstrap_toast(status, title, message){
    let id = uniqid();

    let icon = ''
    if(status == 'success') icon = '<i class="fa-regular fa-circle-check icon-lg" style="color: #63E6BE;"></i>';
    else if(status == 'error') icon = '<i class="fa-solid fa-triangle-exclamation icon-lg" style="color: #ff0000;"></i>';

    let html = `<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" id="`+id+`">
            <div class="toast-header">
                `+icon+`
                <strong class="me-auto">`+title+`</strong>
                <small class="text-body-secondary">just now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                `+message+`
            </div>
        </div>`;

    $('.toast-container').append(html);

    toasts[id] = bootstrap.Toast.getOrCreateInstance($("#" + id));
    toasts[id].show();
}