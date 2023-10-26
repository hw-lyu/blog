import React from "@inertiajs/react";

export default function Header() {
    return (
        <header className="border-solid border-gray-300 border-b shadow-lg">
            <div className="inner flex justify-between">
                <h1 class="text-xl font-bold tracking-wide"><a href="/" class="block">Lumii World</a></h1>
                <nav className="flex">
                    <ul className="flex items-center">
                        <li className="px-3"><a href="">1</a></li>
                        <li className="px-3"><a href="">2</a></li>
                        <li className="px-3"><a href="">3</a></li>
                        <li className="px-3"><a href="">4</a></li>
                        <li className="px-3"><a href="">5</a></li>
                    </ul>
                </nav>
            </div>
        </header>
    );
}
