import React, {createContext, useEffect, useMemo, useState} from "react";
import axios from "axios";

export const MemberContext = createContext({is_admin: false});

export function MemberProvider({children}) {
    const [authData, setAuthData] = useState({is_admin: false});

    useEffect(() => {
        axios.get(`/api/admin/v1/member${location.search}`)
            .then((res) => {
                setAuthData(res.data);
            });
    }, []);

    const value = useMemo(() => (authData), [authData]);

    return <MemberContext.Provider value={value}>{children}</MemberContext.Provider>
}
