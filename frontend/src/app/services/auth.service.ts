import { Injectable } from '@angular/core';
import {environment} from "../../environments/environment";
import {Observable} from "rxjs";
import {HttpClient} from "@angular/common/http";

const accessTokenKey = 'accessToken';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  constructor(
    private http: HttpClient
  ) {}

  logIn(data): Observable<any> {
    const url = environment.host + 'auth?username=' + data.username + "&password=" + data.password;
    return this.http.get<any>(url);
  }

  logOut() {
    sessionStorage.clear();
    localStorage.clear();
  }

  dataLogin(data) {
    this.setData(accessTokenKey, data.data);
  }

  getToken() {
    return this.getData(accessTokenKey);
  }

  setData(key, data) {
    sessionStorage.setItem(key, data);
    localStorage.setItem(key, data);
  }

  getData(key) {
    return sessionStorage.getItem(key) || localStorage.getItem(key);
  }
}
