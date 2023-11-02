import React from "@inertiajs/react";
import HomeLayout from "../Layout/HomeLayout";
import {useEffect, useState} from "react";
import axios from "axios";

type Props = {
    post_id: number
}

export default function Detail({post_id}: Props) {
    const [data, setData] = useState([]);

    useEffect(() => {
        axios.get(`/api/v1/board/post/${post_id}`).then((res) => {
            setData(res.data.post);
        });
    }, []);

    console.log(data);
    return (
        <HomeLayout children>
            <div className="mockup-browser border bg-base-300">
                <div className="mockup-browser-toolbar">
                    <div className="input"><span className="align-sub">{data.subject}</span></div>
                </div>
                <div className="flex justify-center px-4 py-16 bg-base-200">{data.content}</div>
            </div>
        </HomeLayout>
    )
}
