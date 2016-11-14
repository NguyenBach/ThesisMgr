/**
 * Created by quangbach on 13/11/2016.
 */
function changeFilter() {
    var filter = $("#teacher_filter").val();
    console.log(filter);
    if(filter == 1){
        $("#donvi,#linhvuc").css('display','none');
    }
    if(filter == 2){
        $("#donvi").css('display','block');
        $("#linhvuc").css('display','none');
    }
    if(filter == 3){
        $("#donvi").css('display','none');
        $("#linhvuc").css('display','block');
    }

}