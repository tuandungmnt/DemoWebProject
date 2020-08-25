import {Component, OnInit} from '@angular/core';
import {HttpClient} from "@angular/common/http";

@Component({
  selector: 'app-list',
  templateUrl: './list.component.html',
  styleUrls: ['./list.component.css']
})
export class ListComponent implements OnInit {
  result: any;
  id: string = "";
  name: string = "";
  inputId: any;
  url: string = "http://localhost:8000/api/";

  constructor(
    private http: HttpClient
  ) { }

  ngOnInit(): void {
  }

  callAPI() {
    this.http.get<JSON>(this.url+"read?"+"id="+this.inputId).subscribe(data => {
      this.result = JSON.parse(JSON.stringify(data));
      this.id = this.result.id;
      this.name = this.result.name;
    });
  }
}
