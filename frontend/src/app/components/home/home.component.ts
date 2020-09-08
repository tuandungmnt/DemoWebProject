import { Component, OnInit } from '@angular/core';
import {Login} from "../../models/login.model";
import {AuthService} from "../../services/auth.service";
import {Router} from '@angular/router';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {

  username: string = "";
  password: string = "";
  token: string = "";
  url: string = "";
  error: string = "";

  ngOnInit(): void {
  }

  constructor(
    private authService: AuthService,
    private router: Router,
  ) {
    this.token = this.authService.getToken();
  }

  logIn() {
    let loginData: Login = new Login();
    loginData.username = this.username;
    loginData.password = this.password;
    this.authService.logIn(loginData).subscribe(
      next => {
        if (next.status == 'fail') {
          this.showError();
          return;
        }

        this.authService.dataLogin(next);
        this.token = this.authService.getToken();
        console.log(next);

        if (this.username == 'admin') this.url = '/admin'
          else this.url = '/user';
        this.router.navigateByUrl(this.url).then(e => {
          if (e) {
            console.log("Navigation is successful!");
          } else {
            console.log("Navigation has failed!");
          }
        });
      },
      error => {
        console.log(error);
        this.showError();
      }
    )
  }

  showError() {
    this.error = "Username and Password doesn't match!!!"
  }
}
