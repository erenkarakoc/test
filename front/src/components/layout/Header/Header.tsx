import HeaderLogo from "./HeaderLogo/HeaderLogo"
import Button from "../../ui/Button/Button"
import Link from "next/link"
import "./Header.css"

export default function Header() {
  return (
    <header
      className="bg-black border-b-1 border-black-200 mb-10 sticky top-0"
      id="gdz-header"
    >
      <div className="container mx-auto px-40">
        <div className="flex justify-between items-center py-5">
          <HeaderLogo />

          <div className="flex items-center gap-4">
            <Link
              href="#"
              className="font-mono font-medium text-sm text-gray-400 hover:text-white transition-all"
            >
              Algorithms
            </Link>
            <Link
              href="#"
              className="font-mono font-medium text-sm text-gray-400 hover:text-white transition-all"
            >
              Bundles
            </Link>
            <Button className="ml-4">
              <span>Get started</span>
            </Button>
          </div>
        </div>
      </div>
    </header>
  )
}
