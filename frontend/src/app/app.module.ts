
import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HomeComponent } from './components/home/home.component';
import { ListComponent } from './components/list/list.component';
import {FormsModule, ReactiveFormsModule} from "@angular/forms";
import {HTTP_INTERCEPTORS, HttpClientModule} from "@angular/common/http";
import { FormComponent } from './components/form/form.component';
import {AuthService} from "./services/auth.service";
import {ApiService} from "./services/api.service";
import {TokenInterceptor} from "./interceptors/token.interceptor";
import { UserComponent } from './components/user/user.component';
import { AdminComponent } from './components/admin/admin.component';
import {AuthGuard} from "./guards/auth.guard";
import {NbCardModule, NbLayoutModule, NbMenuModule, NbThemeModule} from "@nebular/theme";
import { LayoutComponent } from './layout/layout/layout.component';
import { NoopAnimationsModule } from '@angular/platform-browser/animations';
import { NbEvaIconsModule } from '@nebular/eva-icons';
import { HeaderComponent } from './layout/header/header.component';
import { NavComponent } from './layout/nav/nav.component';

@NgModule({
  declarations: [
    AppComponent,
    HomeComponent,
    ListComponent,
    FormComponent,
    UserComponent,
    AdminComponent,
    LayoutComponent,
    HeaderComponent,
    NavComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    HttpClientModule,
    ReactiveFormsModule,
    NbLayoutModule,
    NoopAnimationsModule,
    NbThemeModule.forRoot({name: 'default'}),
    NbEvaIconsModule,
    NbCardModule,
    NbMenuModule,
  ],
  providers: [
    AuthService,
    ApiService,
    AuthGuard,
    {
      provide: HTTP_INTERCEPTORS,
      useClass: TokenInterceptor,
      multi: true
    }
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
