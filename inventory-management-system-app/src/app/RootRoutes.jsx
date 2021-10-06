import React from 'react'
import { Redirect } from 'react-router-dom'
import dashboardRoutes from './dashboard/DashboardRoutes'
import categoryRoutes from './views/category/CategoryRoutes'
import customerRoutes from './views/customer/CustomerRoutes'
import employeeRoutes from './views/employee/EmployeeRoutes'
import salaryRoutes from './views/salary/SalaryRoutes'
import supplierRoutes from './views/supplier/SupplierRoutes'
import expenseRoutes from './views/expense/ExpenseRoutes'

const redirectRoute = [
    {
        path: '/',
        exact: true,
        component: () => <Redirect to="/dashboard/default" />,
    },
]

const errorRoute = [
    {
        component: () => <Redirect to="/session/404" />,
    },
]

const routes = [
    ...dashboardRoutes,
    ...categoryRoutes,
    ...employeeRoutes,
    ...customerRoutes,
    ...supplierRoutes,
    ...salaryRoutes,
    ...expenseRoutes,

    ...redirectRoute,
    ...errorRoute,
]

export default routes
