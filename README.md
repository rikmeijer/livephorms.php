# live-phorms
microservice for preparing en creating forms with validation

what follows is a first draft on its REST interface

## create form
- possible other handlers: database, e-mail, custom (see below)
POST /form.(json|xml|yaml)
```json
{
    "name" : "MyForm",
    "handler" : ["url", {
	    "method" : "POST",
	    "action" : "/where/to.php",
    }],
    "fieldsets" : {
        "step1" : {
        	"name" : "Personal",
            "fields" : {
                "name" : ["text", {}],
                "phone" : ["phonenumber", {}]
            }
        }

    }
}
```

GET /form/1.html
```html
<form method="POST" action="/where/to.php">
	<fieldset>
		<legend>Personal</legend>
		<p><label for="fld-name"><input id="fld-name" name="name" type="text" /></label></p>
		<p><label for="fld-name"><input id="fld-phone" name="phone" type="text" /></label></p>
	</fieldset>
</form>
```

## create formfield types (with validation)
### Globally
PUT /form/fieldtype/phonenumber.(json|xml|yaml) 

### Form only
PUT /form/1/fieldtype/phonenumber.(json|xml|yaml)
```json
{
    "validators" : {
    	"string" : ["/form/validator/phonedigitsonly.js|/form/validator/1.php", {
    		
    	}],
    	"format-ok" : ["regexp", {
    		"pattern" : "/\+?\d+/"
    	}] 
    }
}
```

## create validator
- static analyses?
- testing?
POST /form/validator.(js|php|ruby|pl)
```php
<?php return function($data) {
	return is_string($data);
};
```

PUT /form/validator/phonedigitsonly.(js|php|ruby|pl)
```javascript
var validator = function(data) {
	return typeof data === "string";
};
```

## create handler
POST /form/handler.(php|js)
```php
<?php return function(array $servicecontainer) {
	// construct environment here
	return function (array $data) { 
		// ... store form data here somehow
	};
};
```

PUT /form/handler/myform.(js|php|ruby|pl)
```javascript
var handler = function(data) {
	
	// ... form is not actually submitted, but passed through this function

};
```


## prepare/use form templates
TODO globally AND form-only?
POST /form/template.(json|xml|yaml)
```html
This form is built using my template
<form>
	...
</form>
```

GET /form/1.(json|xml|yaml)?template=/form/template/1.json
