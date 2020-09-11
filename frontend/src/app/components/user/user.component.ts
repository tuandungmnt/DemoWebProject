import { Component, OnInit } from '@angular/core';
import {AuthService} from "../../services/auth.service";
import {Router} from "@angular/router";
import {ApiService} from "../../services/api.service";

@Component({
  selector: 'app-user',
  templateUrl: './user.component.html',
  styleUrls: ['./user.component.css']
})
export class UserComponent implements OnInit {

  permissionList: string[];

  constructor(
    private authService: AuthService,
    private apiService: ApiService,
    private router: Router,
  ) { }

  ngOnInit(): void {
    this.showAgentPermission();
  }

  logOut() {
    this.authService.logOut();
    this.router.navigateByUrl('/').then(e => {
      if (e) {
        console.log("Navigation is successful!");
      } else {
        console.log("Navigation has failed!");
      }
    });
  }

  showAgentPermission() {
    this.permissionList = this.authService.getPermissions();
  }
}
