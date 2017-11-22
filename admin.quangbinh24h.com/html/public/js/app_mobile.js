window.Mob = {};
window.Mob.c = {};
window.Mob.c.set = function(n,v,exd) {
    var exdate = new Date();
    exdate.setDate(exdate.getDate() + exd);
    var c_value=encodeURI(v) + ((exd==null) ? "" : "; expires="+exdate.toUTCString());
    document.cookie=n + "=" + c_value;
};
window.Mob.c.get = function(n) {
    var c_value = document.cookie;
    var c_start = c_value.indexOf(" " + n + "=");
    if (c_start == -1) {
        c_start = c_value.indexOf(n + "=");
    }
    if (c_start == -1) {
        c_value = null;
    }
    else {
        c_start = c_value.indexOf("=", c_start) + 1;
        var c_end = c_value.indexOf(";", c_start);
        if (c_end == -1) {
            c_end = c_value.length;
        }
        c_value = decodeURI(c_value.substring(c_start,c_end));
    }
    return c_value;
};
var cc = Mob.c.get('checked');
if(cc != 'yes') {
    if(navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPod/i)) {
        Mob.c.set('checked', 'yes', 5);
        location.href = "http://www.nguoiduatin.vn/offer/offer.html";
    }
}