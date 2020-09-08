import { Component, OnInit } from '@angular/core';
import {AuthService} from "../../services/auth.service";
import {Router} from "@angular/router";
import {HttpClient} from "@angular/common/http";
import {ApiService} from "../../services/api.service";

@Component({
  selector: 'app-admin',
  templateUrl: './admin.component.html',
  styleUrls: ['./admin.component.css']
})
export class AdminComponent implements OnInit {
  header: string = "ADMIN"

  result: any;
  url: string = "http://localhost:8000/api/";
  scene: number = 1;

  username: string = "";
  password: string = "";
  email: string = "";
  phone: string = "";

  jobname: string = "";
  description: string = "";

  userid: string = "";
  jobid: string = "";

  s: string = "";
  jobList: string[];
  l: number;

  constructor(
    private http: HttpClient,
    private apiService: ApiService,
    private authService: AuthService,
    private router: Router,
  ) { }

  ngOnInit(): void {
    console.log("CHAM HOI");
  }

  setScene(x: number) {
    this.scene = x;
    this.header = "ADMIN";
  }

  createAgent() {
    /*let data = this.api.createAgent(this.username, this.password, this.phone, this.email)
      .subscribe(
      next => {
        console.log(next);
      },
      error => {
        console.log(error);
      }
    );
    console.log(data);*/
  }

  createJob() {
    this.s = "jobname=" + this.jobname + "&description=" + this.description;
    this.http.get<JSON>(this.url+"create_job?"+this.s).subscribe(data => {
      this.header = "CAI GI VAY TROI";
      console.log(data);
      this.result = JSON.parse(JSON.stringify(data));
      if (this.result.status == "success") {
        this.header = "SUCCESS!";
        this.jobname = "";
        this.description = "";
      }
    });
  }

  createAgentJob() {
    this.s = "userid=" + this.userid + "&jobid=" + this.jobid;
    this.http.get<JSON>(this.url+"create_agent_job?"+this.s).subscribe(data => {
      console.log(data);
      this.result = JSON.parse(JSON.stringify(data));
      if (this.result.status == "success") {
        this.header = "SUCCESS!";
        this.userid = "";
        this.jobid = "";
      }
    });
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

}
