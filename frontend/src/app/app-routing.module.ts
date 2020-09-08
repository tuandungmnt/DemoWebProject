import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { HomeComponent } from "./components/home/home.component";
import { ListComponent } from "./components/list/list.component";
import { FormComponent } from "./components/form/form.component";
import { UserComponent } from "./components/user/user.component";
import { AdminComponent } from "./components/admin/admin.component";

const routes: Routes = [
  { path: '', component: HomeComponent},
  { path: 'list', component: ListComponent},
  { path: 'form', component: FormComponent},
  { path: 'user', component: UserComponent},
  { path: 'admin', component: AdminComponent},
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
