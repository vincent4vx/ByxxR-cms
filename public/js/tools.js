function decompte(time, elem)
{
    var heure = 0;
    var min = 0;
    var sec = 0;
    var disp = "";
    if(time >= 3600)
    {
	 heure = Math.floor(time / 3600);
    }
    if(time >= 60)
    {
	min = Math.floor(time / 60) % 60;
    }
    sec = time % 60;
    if(heure != 0)
    {
	disp += heure + "H ";
    }
    if(min != 0)
    {
	disp += min + "min ";
    }
    if(sec != 0)
    {
	disp += sec + "sec";
    }
    document.getElementById(elem).innerHTML = disp;
    window.setTimeout(decompte, 1000, time - 1, elem);
}


