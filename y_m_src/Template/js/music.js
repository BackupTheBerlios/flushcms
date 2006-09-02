function selectAll(tureOrFalse,checkBoxName)
{
	var TheCheckboxes=document.getElementsByName(checkBoxName);
	for(var i=0;i<TheCheckboxes.length;i++)
		TheCheckboxes[i].checked=tureOrFalse;
}

function goto(to_url, act)
{
	document.admin_list_form.action= to_url + '?act=' + act;
	document.admin_list_form.submit();
}

function jump(to_url)
{
	document.location = to_url;	
}

function delRecord()
{
	if (confirm('Are you sure?')) 
	{
		f = document.createElement('form'); 
		document.body.appendChild(f); 
		f.method = 'POST'; 
		f.action = this.href; 
		f.submit(); 
	};
	return false;
}