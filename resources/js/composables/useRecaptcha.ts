export function useRecaptcha() {
    const executeRecaptcha = async (action: string): Promise<string> => {
        // @ts-ignore
        return await grecaptcha.execute('6LcciEwrAAAAABOmKKRwc5cHkfcNYJi5DP6wmYfV', { action });
    };

    return { executeRecaptcha };
}
