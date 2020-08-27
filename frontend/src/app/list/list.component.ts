import {Component, OnInit} from '@angular/core';
import {HttpClient} from "@angular/common/http";

@Component({
  selector: 'app-list',
  templateUrl: './list.component.html',
  styleUrls: ['./list.component.css']
})
export class ListComponent implements OnInit {
  header: string = "TEST API!!!"

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
    private http: HttpClient
  ) { }

  ngOnInit(): void {
  }

  setScene(x: number) {
    this.scene = x;
    this.header = "TEST API!!!"
  }

  createAgent() {
    this.s = "username=" + this.username + "&password=" + this.password + "&phone=" + this.phone + "&email=" + this.email;
    this.http.get<JSON>(this.url+"create_agent?"+this.s).subscribe(
      data => {
        console.log(data);
        this.result = JSON.parse(JSON.stringify(data));
        if (this.result.status == "success") {
          this.header = "SUCCESS!";
          this.username = "";
          this.password = "";
          this.phone = "";
          this.email = "";
        }
      },
      error => {
        console.log(error);
      });
  }

  createJob() {
    this.s = "jobname=" + this.jobname + "&description=" + this.description;
    this.http.get<JSON>(this.url+"create_job?"+this.s).subscribe(data => {
      console.log(data);
      this.result = JSON.parse(JSON.stringify(data));
      if (this.result.message == "success") {
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
      if (this.result.message == "success") {
        this.header = "SUCCESS!";
        this.userid = "";
        this.jobid = "";
      }
    });
  }

  showAgentJob() {
    this.s = "userid=" + this.userid;
    console.log(this.url+"find_agent_job?"+this.s);
    this.http.get<JSON>(this.url+"find_agent_job?"+this.s).subscribe(
      data => {
        console.log(data);
        this.result = JSON.parse(JSON.stringify(data));
        this.jobList = this.result.data;
        this.l = this.jobList.length;
      },
      error => {
        console.log(error);
      });
  }
}
