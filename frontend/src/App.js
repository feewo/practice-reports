import { useState } from "react";
import "../src/style.css"
import { components } from "./constants/components";

function App() {
  const [page, setPage] = useState("intro");

  return (
    <div className="App">
      <div className="page">
        {components[page]?.()}
      </div>
    </div>
  );
}

export default App;
