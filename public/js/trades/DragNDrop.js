// JavaScript Document
dojo.provide('trades.DragNDrop');
dojo.declare("trades.DragNDrop",[dijit._Widget,dijit._Templated],{
	container: null,
	containerTag: 'span',
	isDraggable:false,
	id: null,
	itemOnClick:false,
	clickOnItem:'',
	items: null,
	
	buildRendering:function()
	{
		this.createContent();
	},
	
	
	checkContainerType:function()
	{
		container = dojo.byId(this.id);
		if(!container)
		{
			console.error('Node with id: ' + this.id + ' doesn\'t exist');
			return;
		}
		
		if(container.tagName == 'TABLE')
			this.containerTag = 'TABLE';
			
		if(container.tagName == 'UL')
			this.containerTag = 'UL';
		return this.containerTag;
	},
	
	clickOnItem:function(id){
		window.location = '/things/editthing?id='+id;
	},
	
	createContent:function()
	{
		if(!this.items)
		{
		    console.error('Param \'items\' is required');
			return;
		}	
	
		widget = this;
		
		if(this.checkContainerType() == 'TABLE')
		{
			var isDraggable = this.isDraggable;
			dojo.forEach(this.items, function(item){
				var tr = dojo.create('tr');
				var imageTD = dojo.create('td');
				var img = dojo.create('img'); 
				var titleTD = dojo.create('td');
				var descriptionTD = dojo.create('td');
				var wishesTD = dojo.create('td');
				img.width = 50;
				tr.draggable = isDraggable;
				
				if(!item.uuid)
    				img.src = "/images/" + "noPhoto.gif";
    			else
        			img.src = "/uploads/" + item.uuid + '.' + item.ext;
				
				imageTD.appendChild(img);
				tr.appendChild(imageTD);
			
				titleTD.innerHTML = item.title;
				tr.appendChild(titleTD);	
				
				descriptionTD.innerHTML = item.description;
				tr.appendChild(descriptionTD);
				
				function handleDragStart(e) {
 					tr.style.opacity = '0.7';
				}
				
				tr.addEventListener('dragstart', handleDragStart, false);
				wishesTD.innerHTML = item.wishes;
				
				tr.appendChild(wishesTD);
				
				if(widget.itemOnClick)
				{
					dojo.connect(tr, 'onclick', function(){
						widget.clickOnItem(item.id)
					});
				}
				
				dojo.place(tr, this.container, 'last');
			});	
			
		}
	}
	
	
});