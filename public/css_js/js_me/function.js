document.getElementById('load').innerHTML=`
<div class="modal fade" id="load" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <br>
    <br>
    <br>
    <br>
    <center>
        <img src="img/dev/loading1.gif" width="140">
    </center>
</div>
</div>`;
function waiting(img,parsing){
    if(parsing==''){
        $("#bodi").hide()
        $("#content").html(`
        <center>
            <img src="img/dev/loading`+img+`.gif">
            <br>
            <br>
            <small><strong>Harap Menunggu...</strong></small>
        </center>
        `);
    }else{
        $("#bodi").show()
        $("#content").html(``);
    }
}
