import Header from "../Component/Header";
import React, {ReactElement} from "react";
import {MemberProvider} from "./MemberContext";

type Props = {
    children: ReactElement
}
export default function HomeLayout({children}: Props) {
    return (
        <>
            <MemberProvider children>
                <div className="wrap">
                    <Header></Header>
                    <div className="max-w-[808px] mt-10 ml-auto mr-auto pt-3 pb-3 pl-5 pr-5">
                        {children}
                    </div>
                </div>
            </MemberProvider>
        </>
    );
}
