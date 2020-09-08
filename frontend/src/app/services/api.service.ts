import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import { Observable } from "rxjs";
import {environment} from "../../environments/environment";
import {AgentModel} from "../models/agent.model";

@Injectable({
  providedIn: 'root'
})
export class ApiService {
  constructor(
    private http: HttpClient
  ) { }

  createAgent(agentData: AgentModel) : Observable <any> {
    let url = environment.host + "create_agent?username=" + agentData.username + "&password=" + agentData.password + "&phone=" + agentData.phone + "&email=" + agentData.email;
    return this.http.get<any>(url);
  }

  getAgentJobByToken(): Observable<any> {
    let url = environment.host + "get_agent_job_by_token";
    return this.http.get<any>(url);
  }
}
