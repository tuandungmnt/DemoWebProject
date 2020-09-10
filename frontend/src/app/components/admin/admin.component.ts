import { Component, OnInit } from '@angular/core';
import {AuthService} from "../../services/auth.service";
import {Router} from "@angular/router";
import {HttpClient} from "@angular/common/http";
import {ApiService} from "../../services/api.service";
import {FormControl, FormGroup, Validators} from "@angular/forms";
import {Observable} from "rxjs";

@Component({
  selector: 'app-admin',
  templateUrl: './admin.component.html',
  styleUrls: ['./admin.component.css']
})
export class AdminComponent implements OnInit {
  header: string = "ADMIN"
  scene: number = 1;
  message: string = "";
  data: Observable <any>;
  userName: string = "";
  jobName: string = "";
  groupName: string = "";
  permission: string = "";

  form: FormGroup;

  constructor(
    private http: HttpClient,
    private apiService: ApiService,
    private authService: AuthService,
    private router: Router,
  ) { }

  ngOnInit(): void {
    this.form = new FormGroup({
      username: new FormControl(),
      password: new FormControl(),
      phone: new FormControl(),
      email: new FormControl(),
      jobName: new FormControl(),
      groupName: new FormControl(),
      permission: new FormControl(),
      description: new FormControl(),
      userid: new FormControl(),
      jobId: new FormControl(),
      groupId: new FormControl(),
      permissionId: new FormControl(),
    });
    this.form.get('userid').valueChanges.subscribe(
      next =>{
        this.apiService.findAgent(next).subscribe(
          next => {
            let result = JSON.parse(JSON.stringify(next));
            if (result.status == "success") this.userName = result.data.username;
              else this.userName = "";
          },
          error => {
            this.userName = "";
          }
        )
      }
    )
    this.form.get('jobId').valueChanges.subscribe(
      next =>{
        this.apiService.findJob(next).subscribe(
          next => {
            let result = JSON.parse(JSON.stringify(next));
            if (result.status == "success") this.jobName = result.data.jobname;
              else this.jobName = "";
          },
          error =>{
            this.jobName = "";
          }
        )
      }
    )
    this.form.get('groupId').valueChanges.subscribe(
      next =>{
        this.apiService.findGroup(next).subscribe(
          next => {
            let result = JSON.parse(JSON.stringify(next));
            if (result.status == "success") this.groupName = result.data.groupname;
            else this.groupName = "";
          },
          error => {
            this.groupName = "";
          }
        )
      }
    )
    this.form.get('permissionId').valueChanges.subscribe(
      next =>{
        this.apiService.findPermission(next).subscribe(
          next => {
            let result = JSON.parse(JSON.stringify(next));
            if (result.status == "success") this.permission = result.data.permission;
            else this.permission = "";
          },
          error =>{
            this.permission = "";
          }
        )
      }
    )
  }

  setScene(x: number) {
    this.scene = x;
    this.message = "";
    this.form.reset();
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

  submit() {
    this.message = "";

    if (!this.form.valid) {
      this.message = "Invalid input";
      return;
    }
    console.log(this.form.value);
    switch (this.scene) {
      case 1: {
        this.data = this.apiService.createAgent(this.form.value);
        break;
      }
      case 2: {
        this.data = this.apiService.createJob(this.form.value);
        break;
      }
      case 3: {
        this.data = this.apiService.createGroup(this.form.value);
        break;
      }
      case 4: {
        this.data = this.apiService.createPermission(this.form.value);
        break;
      }
      case 5: {
        this.data = this.apiService.createAgentJob(this.form.value);
        break;
      }
      case 6: {
        this.data = this.apiService.createJobGroup(this.form.value);
        break;
      }
      case 7: {
        this.data = this.apiService.createGroupPermission(this.form.value);
        break;
      }
    }
    this.form.reset();
    this.data.subscribe(
      next => {
        console.log(next);
        let result = JSON.parse(JSON.stringify(next));
        // if (result.status == "fail") this.message = "FAIL!!!";
        //     else this.message = result.message;
        this.message = result.message;
      },
      error => {
        console.log(error);
        this.message = "FAIL!!!";
      }
    );
    console.log(this.data);
  }
}
