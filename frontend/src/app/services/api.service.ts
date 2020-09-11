import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import { Observable } from "rxjs";
import {environment} from "../../environments/environment";

@Injectable({
  providedIn: 'root'
})
export class ApiService {
  constructor(
    private http: HttpClient
  ) { }

  createAgent(data) : Observable <any> {
    let url = environment.host + "create_agent?username=" + data.username + "&password=" + data.password + "&phone=" + data.phone + "&email=" + data.email;
    return this.http.get<any>(url);
  }

  createJob(data) : Observable<any> {
    let url = environment.host + "create_job?jobname=" + data.jobName + "&description=" + data.description;
    return this.http.get<any>(url);
  }

  createGroup(data) : Observable<any> {
    let url = environment.host + "create_group?groupname=" + data.groupName + "&description=" + data.description;
    return this.http.get<any>(url);
  }

  createPermission(data) : Observable<any> {
    let url = environment.host + "create_permission?permission=" + data.permission + "&description=" + data.description;
    return this.http.get<any>(url);
  }

  createAgentJob(data) : Observable<any> {
    let url = environment.host + "create_agent_job?userid=" + data.userid + "&jobid=" + data.jobId;
    return this.http.get<any>(url);
  }

  createJobGroup(data) : Observable<any> {
    let url = environment.host + "create_job_group?jobid=" + data.jobId + "&groupid=" + data.groupId;
    return this.http.get<any>(url);
  }

  createGroupPermission(data) : Observable<any> {
    let url = environment.host + "create_group_permission?groupid=" + data.groupId + "&permissionid=" + data.permissionId;
    return this.http.get<any>(url);
  }

  findAgent(id) : Observable<any> {
    let url = environment.host + "find_agent?userid=" + id;
    return this.http.get<any>(url);
  }

  findJob(id) : Observable<any> {
    let url = environment.host + "find_job?jobid=" + id;
    return this.http.get<any>(url);
  }

  findGroup(id) : Observable<any> {
    let url = environment.host + "find_group?groupid=" + id;
    return this.http.get<any>(url);
  }

  findPermission(id) : Observable<any> {
    let url = environment.host + "find_permission?permissionid=" + id;
    return this.http.get<any>(url);
  }
}
