import Link from "next/link"
import "./Button.css"

export default function Button({
  children,
  className,
  link,
}: {
  children: React.ReactNode
  className?: string
  link?: string
}) {
  if (link) {
    return (
      <Link
        href={link}
        className={`bg-primary font-mono font-medium text-sm text-white px-4 py-1 rounded-xl cursor-pointer border-3 border-secondary hover:bg-secondary w-fit ${className}`}
      >
        {children}
      </Link>
    )
  } else {
    return (
      <button
        className={`bg-primary font-mono font-medium text-sm text-white px-4 py-1 rounded-xl cursor-pointer border-3 border-secondary hover:bg-secondary w-fit ${className}`}
      >
        {children}
      </button>
    )
  }
}
