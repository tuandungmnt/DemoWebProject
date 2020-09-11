import { Injectable } from '@angular/core';
import {environment} from "../../environments/environment";
import {Observable} from "rxjs";
import {HttpClient} from "@angular/common/http";
import {stringify} from "@angular/compiler/src/util";
import {toArray} from "rxjs/operators";

const accessTokenKey = 'accessToken';
const urlKey = 'url';
const permissionsKey = 'permissions';

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
    this.setData(accessTokenKey, data.data.token);
    this.setData(urlKey, data.data.url);
    this.setData(permissionsKey, JSON.stringify(data.data.permissions));
  }

  getToken() {
    return this.getData(accessTokenKey);
  }

  getUrl() {
    return this.getData(urlKey);
  }

  getPermissions() {
    return JSON.parse(this.getData(permissionsKey));
  }

  setData(key, data) {
    sessionStorage.setItem(key, data);
    localStorage.setItem(key, data);
  }

  getData(key) {
    return sessionStorage.getItem(key) || localStorage.getItem(key);
  }
}
