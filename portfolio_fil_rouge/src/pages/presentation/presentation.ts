import { Component } from '@angular/core';
import { Http } from '@angular/http';
import 'rxjs/RX';

@Component({
  selector: 'page-presentation',
  templateUrl: 'presentation.html'
})

export class PresentationPage {

	langages: any; 

  	constructor(public http: Http) {
    	
      	this.http.get('http://pacoret.chalon.codeur.online/API/api.php?langages').map(res => res.json()).subscribe(data => { console.log(data);
        this.langages = data;
      	});
	}
}	
