banditResults = Array(
    Array("male","female"),
    Array("left-handed","right-handed"),
    Array("happy","sad"),
    Array("wide awake","sleepy")
)

function count(arr, value){
    out = 0
    for(var i=0;i<arr.length;i++){
        if(arr[i] == value){out++}
    }
    return out
}

resultls = Array()
actuals = Array(-1,-1,-1,-1);
corrects = Array(-1,-1,-1,-1);
running = false
blocks = Array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0)

dataDefault = Array(
    0,// number of clicks in first half
    0,// number of clicks in second half
    0,// max reds in first half
    0,// max reds in second half
    0,// max blues in first half
    0,// max blues in second half
    25,// min reds in second half
    25,// min blues in second half
    25,// min greys in first half
    25,// min greys in second half
    0,// longest gap between clicks
    20000,// shortest gap between clicks
    0,// total clicks in column 1
    0,// total clicks in column 2
    0,// total clicks in column 3
    0,// total clicks in column 4
    0,// total clicks in column 5
    0,// total clicks in row 1
    0,// total clicks in row 2
    0,// total clicks in row 3
    0,// total clicks in row 4
    0// total clicks in row 5
)

data = dataDefault.slice()

clicks = Array()

cols = Array("#EEEEEE","red","blue")
prev = 0
startTime = 0
ticker = 0
playback = false
function click(n){
    if(running){
        change(n)
        if(!playback){
            clicks[clicks.length] = Array(milli(),n)
            // first half
            data[0]++
        } else {
            // second half
            data[1]++
        }
        if(prev != 0){
            data[10] = Math.max(data[10],milli()-prev)
            data[11] = Math.min(data[11],milli()-prev)
        }
        prev = milli()
        data[12+Math.floor(n/5)] += 1
        data[17+n%5] += 1
    }
}
function change(n){
    blocks[n] += 1
    blocks[n] %= 3
    document.getElementById("bandit-"+n).style.backgroundColor = cols[blocks[n]]
    if(!playback){
        // first half
        data[2] = Math.max(data[2],count(blocks,1))
        data[4] = Math.max(data[4],count(blocks,2))
        data[8] = Math.min(data[8],count(blocks,0))
    } else {
        // second half
        data[3] = Math.max(data[3],count(blocks,1))
        data[5] = Math.max(data[5],count(blocks,2))
        data[6] = Math.min(data[6],count(blocks,2))
        data[7] = Math.min(data[7],count(blocks,1))
        data[9] = Math.min(data[9],count(blocks,0))
    }
}
function sec(){
    return 20-Math.floor(milli() / 1000)
}
function milli(){
    return new Date().getTime()-startTime
}
function millinow(){
    return new Date().getTime()
}
function start(){
    blocks = Array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0)
    clicks = Array()
    data = dataDefault.slice()
    prev = 0
    actuals = Array(-1,-1,-1,-1);
    corrects = Array(-1,-1,-1,-1);
    for(var n=0;n<25;n++){document.getElementById("bandit-"+n).style.backgroundColor = cols[0]}
    running = true
    playback = false
    hide_infobox()
    startTime = millinow()
    ticker = setInterval(tick,50)
}
function stop(){
    clearInterval(ticker)
    running = false
    var resulter;
    if(window.XMLHttpRequest){resulter=new XMLHttpRequest();}
    else {resulter=new ActiveXObject('Microsoft.XMLHTTP');}
    resulter.onreadystatechange=function(){
        if (resulter.readyState==4 && resulter.status==200){
            resultls = resulter.responseText.split(",")
            out = "<h1>Results</h1>"
            out += "<p>The Bandit thinks that you are "
            alert(resultls)
            for(var i=0;i<resultls.length;i++){
                if(resultls[i]>0.5){
                    out += banditResults[i][1]
                } else {
                    out += banditResults[i][0]
                }
                if(i==resultls.length-2){
                    out += ", and "
                } else if(i<resultls.length-2){
                    out += ", "
                }
            }
            out += ". "
            out += "Is The Bandit correct?</p>"
            out += "<p>"
            for(var i=0;i<resultls.length;i++){
                if(resultls[i]>0.5){
                    out += banditResults[i][1]
                } else {
                    out += banditResults[i][0]
                }
                out += ": <span id='r"+i+"'><a href='javascript:yes("+i+")'>yes</a> <a href='javascript:no("+i+")'>no</a></span><br />"
            }
            out += "</p>"
            infobox(out)
        }
    }
    resulter.open('POST','get_result.php',true);
    resulter.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    resulter.send(postdata());
}

function hide_infobox(){
    document.getElementById("infobox").style.display = "none"
}
function infobox(txt){
    document.getElementById("infobox").innerHTML = txt
    document.getElementById("infobox").style.display = "block"
}

function thanks(){
    infobox("<h1>Thanks</h1><p>The Bandit will learn from the data you have given it and will hopefully get cleverer...</p><a class='starter' href='javascript:again()'>Play again</a><a class='starter' href='/bandit/info'>More info</a>")
}
function saving(){
    infobox("<h1>Saving data</h1><p>Please wait</p>");
}
function again(){
    infobox("<h1>The Bandit</h1><p>Click/touch the squares to change their colour. After 20 seconds, The Bandit will make some predictions about you.</p><a class='starter' href='javascript:start()'>Begin</a>")
}
function yes(i){
    actuals[i] = resultls[i]
    corrects[i] = 1
    document.getElementById("r"+i).innerHTML = "<b>yes</b>"
    if(count(actuals,-1)==0){
        savedata()
    }
}
function no(i){
    actuals[i] = 1-resultls[i]
    corrects[i] = 0
    document.getElementById("r"+i).innerHTML = "<b>no</b>"
    if(count(actuals,-1)==0){
        savedata()
    }
}
function savedata(){
    saving()
    var saver;
    if(window.XMLHttpRequest){saver=new XMLHttpRequest();}
    else {saver=new ActiveXObject('Microsoft.XMLHTTP');}
    saver.onreadystatechange=function(){
        if (saver.readyState==4 && saver.status==200){
            alert(saver.responseText)
            if (saver.responseText == "locked"){
                setTimeout(savedata,1000)
            } else {
                thanks()
            }
        }
    }
    saver.open('POST','save_data.php',true);
    saver.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // TODO: send and keep track of number of correct / incorrect guesses for each category
    saver.send(postactual()+"&"+postdata()+"&"+correctdata());
}
function postdata(){
    send_me = Array()
    for(var i=0;i<data.length;i++){
        send_me[send_me.length] = "data"+i+"="+data[i]
    }
    return send_me.join("&")
}
function correctdata(){
    send_me = Array()
    for(var i=0;i<corrects.length;i++){
        send_me[send_me.length] = "correct"+i+"="+corrects[i]
    }
    return send_me.join("&")
}
function postactual(){
    send_me = Array()
    for(var i=0;i<actuals.length;i++){
        send_me[send_me.length] = "actual"+i+"="+actuals[i]
    }
    return send_me.join("&")
}
function tick(){
    left = sec()
    if(left<=10){
        playback = true
        while(clicks.length > 0 && clicks[0][0] < milli()-10000){
            change(clicks[0][1])
            clicks = clicks.slice(1,clicks.length)
        }
    }
    if(left<10){document.getElementById("timer").innerHTML = "0:0"+left}
    else {document.getElementById("timer").innerHTML = "0:"+left}
    if(left<=0){stop()}
}

document.getElementById("timer").innerHTML = "0:20"
again()
