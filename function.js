function ClearTextArea(){
    document.getElementById("textarea").value="";
}

function copyTuijian()
{
    var fztj=document.getElementById("fztj");
    fztj.select();
    document.execCommand("Copy"); // 执行浏览器复制命令
    alert("复制成功");
}
