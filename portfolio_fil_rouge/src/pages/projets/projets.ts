import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import { Http } from '@angular/http';
import 'rxjs/RX';

import { ProjetSeulPage } from '../projetseul/projetseul';

@Component({
  selector: 'page-projets',
  templateUrl: 'projets.html'
})

export class ProjetsPage {
  
	selectionProjet: any;
  
  projets: any; 

  	constructor(public navCtrl: NavController, public navParams: NavParams, public http: Http) {
    	
      this.http.get('http://pacoret.chalon.codeur.online/API/api.php?projet').map(res => res.json()).subscribe(data => { console.log(data);
        this.projets = data;

        this.selectionProjet = navParams.get('projet');
      });
    	
  	}

  	projetChoisi(event, projet) {
    	this.navCtrl.push(ProjetSeulPage, {
      	projet: projet
    	});
  	}
}
	
