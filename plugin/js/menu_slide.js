/**
 * Created by Aboushirie on 12/28/2017.
 */


var toggled=false;
function toggle() {

    if(!toggled){
        toggled=true;
        document.getElementById('menu_container').style.cssText = 'display:block';

        return;
    }

    if(toggled){
        toggled=false;
        document.getElementById('menu_container').style.cssText = 'display:none';
        return;
    }

}