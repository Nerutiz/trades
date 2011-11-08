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

                if(container.tagName == 'DIV')
			this.containerTag = 'DIV';
		return this.containerTag;
	},
	
	clickOnItem:function(id){
		window.location = '/things/editthing?id='+id;
	},
	
        descriptionEllipsis:function(text)
        {
            symbolsToShow = 130; 
            if(text.length > symbolsToShow + 3)
            {
                ellipsedText = '';
                for(var i = 0; i < symbolsToShow; i++)
                {
                   ellipsedText += text[i];
                }
                ellipsedText += "..."; 
                return ellipsedText;
            }
            else
                return text;
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
                
                
                if(this.checkContainerType() == 'DIV')
		{
                    
                    isDraggable = this.isDraggable;
                    dojo.forEach(this.items, function(item){
                            var itemContainer = dojo.create('div');
                            var titleEl = dojo.create('p');
                            var img = dojo.create('img'); 
                            var descriptionEl = dojo.create('p');
                            var wishEl = dojo.create('p');
                            
                            dojo.connect(itemContainer, 'onclick', function(){ window.location.href="/trades/thing?itemid=" + item.id});
                            
                            
                            img.width = 80;
                            img.height = 80;
                            itemContainer.draggable = isDraggable;

                            if(!item.uuid)
                                img.src = "/images/" + "noPhoto.gif";
                            else
                                img.src = "/uploads/" + item.uuid + '.' + item.ext;

           
                            itemContainer.appendChild(img);

                            titleEl.innerHTML = item.title;
                            itemContainer.appendChild(titleEl);	

                            descriptionEl.innerHTML = widget.descriptionEllipsis(item.description);
                            itemContainer.appendChild(descriptionEl);
                          
                            wishEl.innerHTML = item.wishes;

                            itemContainer.appendChild(wishEl);

                            if(widget.itemOnClick)
                            {
                                    dojo.connect(tr, 'onclick', function(){
                                            widget.clickOnItem(item.id)
                                    });
                            }
                            
                            dojo.addClass(itemContainer, 'itemContainer');
                            dojo.addClass(titleEl, 'itemTitle');
                            dojo.addClass(descriptionEl, 'itemDesc');
                            dojo.addClass(wishEl, 'itemWish');

                            dojo.place(itemContainer, this.container, 'last');
                    });	

		}
                
                
	}
	
	
});