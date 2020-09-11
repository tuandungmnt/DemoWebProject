import { Component, OnInit } from '@angular/core';
import {AuthService} from "../../services/auth.service";
import {Router} from '@angular/router';
import {FormControl, FormGroup, Validators} from "@angular/forms";
@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
  error: string = "";
  loginForm: FormGroup;


  ngOnInit(): void {
    this.loginForm = new FormGroup({
      username: new FormControl("",[
        Validators.required,
      ]),
      password: new FormControl("",[
        Validators.required,
      ])
    });
  }

  constructor(
    private authService: AuthService,
    private router: Router,
  ) {
  }

  logIn() {
    if (!this.loginForm.valid) {
      this.error = "Invalid username or password";
      return;
    }

    console.log(this.loginForm.value);
    this.authService.logIn(this.loginForm.value).subscribe(
      next => {
        if (next.status == 'fail') {
          this.error = "Username and Password doesn't match!!!"
          return;
        }

        this.authService.dataLogin(next);
        console.log(next);

        let url: string = this.authService.getUrl();
        this.router.navigateByUrl(url).then(e => {
          if (e) {
            console.log("Navigation is successful!");
          } else {
            console.log("Navigation has failed!");
          }
        });
      },
      error => {
        console.log(error);
        this.error = "Error!"
      }
    )
  }
}
