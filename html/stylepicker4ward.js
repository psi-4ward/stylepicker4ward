var Stylepicker4ward = new Class(
{
	
    initialize: function(cont,parentField)
    {
		this.checkboxes = cont.getElements('input');
	
		// find parent class-field
		var parentField = parent.document.getElementById(parentField);
		if(parentField == null)
		{
			alert('Parent-Field not found! [E11]');
			return;
		}
		if(parentField.get('tag') != 'input')
		{
			parentField = parentField.getElements('input');
			if(parentField == null || parentField.length < 1)
			{
				alert('Parent-Field not found! [E12]');
				return;
			}
			this.parentField = parentField[parentField.length-1];
		}
		else
		{
			this.parentField = parentField;
		}

		// set click-events
    	cont.getElements('.item').each(function(el){
    		el.addEvent('click',this.clickItem.bindWithEvent(this,[el]));
    	}.bind(this));
    	
    	// check checkboxes if a classname is set
    	var classes = this.parentField.get('value').trim().split(' ');
    	for(var i=0;i<classes.length;i++)
    	{
    		for(var j=0;j<this.checkboxes.length;j++)
    		{
    			if(classes[i] == this.checkboxes[j].get('value'))
    				this.checkboxes[j].checked = true;
    		}
    	}
    	
	},
	
	clickItem: function(e,el)
	{
		var inp = el.getElement('input');
		if(e == null || e.target.get('tag') != 'input')
		{
			inp.checked = !inp.checked;
		}
		
		// update parent-field
		var classname = inp.get('value');
		var classes = this.parentField.get('value').trim().split(' ');
		if(inp.checked)
		{
			// add classname
			if(!classes.contains(classname))
				classes.push(classname)
			
		}
		else
		{
			// remove classname
			classes.erase(classname);
		}
		this.parentField.set('value',classes.join(' '));
	}
	
});

