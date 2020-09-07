import { Injectable } from '@angular/core';
import {
  HttpRequest,
  HttpHandler,
  HttpEvent,
  HttpInterceptor
} from '@angular/common/http';
import { Observable } from 'rxjs';
import {AuthService} from "../services/auth.service";

@Injectable()
export class TokenInterceptor implements HttpInterceptor {

  constructor(private authService: AuthService) {}

  intercept(req: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
    const headersConfig = {
      'Content-Type' : 'application/json',
      'Accept'       : 'application/json'
    };

    const token = this.authService.getToken ();
    if (token) {
      headersConfig['token'] = `${ token }`;
    }

    const request = req.clone ({setHeaders : headersConfig});
    return next.handle (request);
  }
}
