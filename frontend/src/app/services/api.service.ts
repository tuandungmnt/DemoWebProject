import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import { Observable } from "rxjs";

@Injectable({
  providedIn: 'root'
})
export class ApiService {
  url: string = "http://localhost:8000/api/";

  constructor(
    private http: HttpClient
  ) { }

  createAgent(username, password, phone, email) : Observable <any> {
    let s = "username=" + username + "&password=" + password + "&phone=" + phone + "&email=" + email;
    let r = this.url + "create_agent?" + s;
    return this.http.get<any>(r);
  }
}
