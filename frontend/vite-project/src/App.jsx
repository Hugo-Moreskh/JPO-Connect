import { createBrowserRouter, RouterProvider } from "react-router-dom";
import { RootLayout } from "./pages/Root";
import { HomePage } from "./pages/HomePage";
import { RootLayoutAdmin } from "./pages/admin/RootAdmin";
import AdminPage from "./pages/admin/AdminPage";
import EventJpo from "./pages/admin/EventJpoPage";

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
        {
          path: "event-jpo", 
          element: <EventJpo />,
        },
      ],
    },
  ]);

  return <RouterProvider router={router} />;
}
