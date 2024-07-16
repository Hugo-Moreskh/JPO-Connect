import { createBrowserRouter, RouterProvider } from "react-router-dom";
import { RootLayout } from "./pages/Root";
import { HomePage } from "./pages/HomePage";
import { RootLayoutAdmin } from "./pages/admin/RootAdmin";
import AdminPage from "./pages/admin/AdminPage";

export default function App() {
  const router = createBrowserRouter([
    {
      path: "/",
      element: <RootLayout />,
      children: [
        {
          path: "/",
          element: <HomePage />,
        },
      ],
    },
    {
      path: "/admin",
      element: <RootLayoutAdmin />,
      // loader
      children: [
        {
          path: "",
          element: <AdminPage />,
        },
      ],
    },
  ]);

  return <RouterProvider router={router} />;
}
