import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';


import { Http } from '@angular/http';
import 'rxjs/RX';

@Component({
  selector: 'page-contact',
  templateUrl: 'contact.html'
})

export class ContactPage {

	text: string;

    todo = {
    	nom:'',
	    mail:'',
	    sujet:'',
	    message:'',
	    contact:''
    };

    constructor(public navCtrl: NavController, public navParams: NavParams, public http: Http) {}


    logForm(form) {
    	console.log('aaaa');
		this.http.get('http://pacoret.chalon.codeur.online/API/api.php?nom='+ form.value.nom + '&mail=' + form.value.mail + '&sujet=' + form.value.sujet + '&message=' + form.value.message + '&contact=true').map(res => res.json()).subscribe(data => {

        						this.text = data;});
    } 

}