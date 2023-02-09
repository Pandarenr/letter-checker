url = document.location.href+'check';
lang = document.getElementById('lang').innerHTML;
lang = lang.replace(/\s/g, '');
csrf = document.querySelector('meta[name="csrf-token"]').content;

const input = document.querySelector('#string');
input.addEventListener('input', updateValue);

function updateValue(e) {
    if(lang){
        makeRequest(url,e.target.value);
    }
}



console.log(lang);

if(lang){
    
    function makeRequest(url,string) {
        var httpRequest = false;
    
        if (window.XMLHttpRequest) { // Mozilla, Safari, ...
            httpRequest = new XMLHttpRequest();
            if (httpRequest.overrideMimeType) {
                httpRequest.overrideMimeType('text/xml');
                // Читайте ниже об этой строке
            }
        } else if (window.ActiveXObject) { // IE
            try {
                httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                try {
                    httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (e) {}
            }
        }
    
        if (!httpRequest) {
            alert('Не вышло :( Невозможно создать экземпляр класса XMLHTTP ');
            return false;
        }
        httpRequest.onreadystatechange = function() { updateString(httpRequest); };
        httpRequest.open('POST', url, true);
        httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        httpRequest.setRequestHeader('X-CSRF-TOKEN', csrf);
        httpRequest.send('string='+string+'&lang='+lang);
    
    }
    
    function updateString(httpRequest) {
        if (httpRequest.readyState == 4) {
            if (httpRequest.status == 200) {
                data=JSON.parse(httpRequest.responseText);
                document.getElementById('output').innerHTML=data.markedString;
            } else {
                alert('С запросом возникла проблема.');
            }
        }
    }
}