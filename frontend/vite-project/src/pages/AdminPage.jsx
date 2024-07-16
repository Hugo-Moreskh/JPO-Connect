import Header from "../components/AdminHeader";
import AdminDashBoard from "../components/AdminDashboard";
import "../App.css";

function AdminPage() {
  return (
    <div>
      <Header />
      <main>
        <AdminDashBoard />
      </main>
    </div>
  );
}

export default AdminPage;
