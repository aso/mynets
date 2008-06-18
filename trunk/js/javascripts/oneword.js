function makeoneword() {
    new Ajax.InPlaceEditor("oneword", oneword_url, {
        okText : "今日のひとこと",
        cancelText : "キャンセル",
        savingText : "保存中です...",
        clickToEditText : "クリックすると編集できます",
        rows:1,
        cols:30,
        onFailure : function(){ alert("36文字以下にしてください"); }
    });
}

function makeballoon() {
    if(!document.getElementById || !document.getElementsByTagName) {
        return;
    }
    var links=document.getElementsByClassName('oneword_bln');
    for(i=0;i<links.length;i++) {
        load(links[i]);
    }
}

function load(e) {
    var title = e.getAttribute("title");
    e.removeAttribute("title");
    var balloon = document.createElement("span");
    balloon.className = "balloon";
    balloon.style.display = "block";
    balloon.style.position = "absolute";
    balloon.style.bottom = "0px";
    text = document.createElement("span");
    text.className = "text";
    text.style.display = "block";
    text.appendChild(document.createTextNode(title));
    balloon.appendChild(text);
    var btm = document.createElement("b");
    btm.className = "bottom";
    btm.style.display = "block";
    balloon.appendChild(btm);
    e.balloon = balloon;
    e.onmouseover = showbln;
    e.onmouseout = hidebln;
    e.onmousemove = move;
}

function showbln(e) {
    $("wedge").appendChild(this.balloon);
}

function hidebln(e) {
    var d = $("wedge");
    if(d.childNodes.length > 0) {
        d.removeChild(d.firstChild);
    }
}

function move(e) {
    var x = 0,y = 0;
    if(e == null) {
        e = window.event;
    }
    x = Event.pointerX(e);
    y = Event.pointerY(e);
    $("wedge").style.top = (y-30)+"px";
    $("wedge").style.left = (x-35)+"px";
    $("wedge").style.zIndex = '100';
}
