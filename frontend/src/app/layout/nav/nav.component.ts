import { ChangeDetectionStrategy, Component, OnInit } from '@angular/core';
import {NbMenuItem} from "@nebular/theme";

@Component({
  selector: 'app-nav',
  templateUrl: './nav.component.html',
  styleUrls: ['./nav.component.css'],
  changeDetection: ChangeDetectionStrategy.OnPush,
})
export class NavComponent implements OnInit {
  items: NbMenuItem[] = [
    {
      title: 'Profile',
      expanded: true,
      children: [
        {
          title: 'Change Password',
        },
        {
          title: 'Privacy Policy',
        },
        {
          title: 'Logout',
        },
      ],
    },
    {
      title: 'Shopping Bag',
      children: [
        {
          title: 'First Product',
        },
        {
          title: 'Second Product',
        },
        {
          title: 'Third Product',
        },
      ],
    },
    {
      title: 'Orders',
      children: [
        {
          title: 'First Order',
        },
        {
          title: 'Second Order',
        },
        {
          title: 'Third Order',
        },
      ],
    },
  ];

  constructor() { }

  ngOnInit(): void {
  }

}
