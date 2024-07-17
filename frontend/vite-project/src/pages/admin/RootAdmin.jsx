import Header from "../../components/layout-admin/AdminHeader";
import AdminDashBoard from "../../components/layout-admin/AdminDashboard";
import "../../App.css";
import { Outlet } from "react-router-dom";

export const RootLayoutAdmin = () => {
  return (
  <div>
  <Header />
  <main style={{ display: "flex", height: "70vh" }}>
    <AdminDashBoard />
    <Outlet/>
  </main>
  
</div>
  )
};
