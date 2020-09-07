import { Component, OnInit } from '@angular/core';
import {Login} from "../../models/login.model";
import {AuthService} from "../../services/auth.service";

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {

  username: string = "";
  password: string = "";
  token: string = "";

  ngOnInit(): void {
  }

  constructor(
    private authService: AuthService
  ) {
    this.token = this.authService.getToken();
  }

  logIn() {
    let loginData: Login = new Login();
    loginData.username = this.username;
    loginData.password = this.password;
    this.authService.logIn(loginData).subscribe(
      next => {
        this.authService.dataLogin(next);
        this.token = this.authService.getToken();
        console.log(next);
      },
      error => {
        console.log(error);
      }
    )
  }

  logOut() {
    this.authService.logOut();
    this.token = this.authService.getToken();
  }
}
