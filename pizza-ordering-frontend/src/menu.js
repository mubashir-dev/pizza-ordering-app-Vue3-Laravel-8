import {
  mdiAccountCircle,
  mdiDesktopMac,
  mdiShieldAccount,
  mdiBookPlus,
  mdiPizza,
  mdiAccountGroup,
  mdiClipboardFileOutline,
  mdiClipboardList
} from '@mdi/js'

export default [
  'General',
  [
    {
      to: '/dashboard',
      icon: mdiDesktopMac,
      label: 'Dashboard'
    }
  ],
  // 'Examples',
  [
    {
      label: "Pizza's",
      icon: mdiPizza,
      updateMark: true,
      menu: [
        {
          label: 'Create Pizza',
          to: '/create-pizza',
          icon: mdiBookPlus

        },
        {
          label: 'Available Pizzas',
          to: '/pizzas',
          icon: mdiClipboardList

        }
      ]
    },
    {
      label: 'Pizza Categories',
      icon: mdiPizza,
      updateMark: true,
      menu: [
        {
          label: 'Create Category',
          to: '/create-category',
          icon: mdiBookPlus

        },
        {
          label: 'Category List',
          to: '/pizza-categories',
          icon: mdiClipboardList

        }
      ]
    },
    {
      to: '/customers',
      label: "Customer's",
      icon: mdiAccountGroup
    },
    {
      to: '/orders',
      label: "Order's",
      icon: mdiClipboardFileOutline
    },
    {
      to: '/users',
      label: "User's",
      icon: mdiAccountCircle,
      menu: [
        {
          label: 'Create User',
          icon: mdiBookPlus

        },
        {
          label: 'All Users',
          icon: mdiClipboardList

        }
      ]
    }
  ],
  'About',
  [
    {
      href: '/',
      label: 'Developer Profile',
      icon: mdiShieldAccount
    }
  ]
]
