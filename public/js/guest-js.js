/**
 * Created by quangbach on 13/11/2016.
 */
function donviClick(myself) {
    var display = $(myself).next().css("display");
    if(display == "none"){
        $(myself).next().css("display","");
    }else{
        $(myself).next().css("display","none");
    }

}

