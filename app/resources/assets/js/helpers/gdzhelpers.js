window.getAssetPrice = async symbol => {
  try {
    const response = await fetch(`https://api.binance.com/api/v3/ticker/price?symbol=${symbol.toUpperCase()}USDT`);

    if (response.ok) {
      const data = await response.json();
      return parseFloat(data.price).toFixed(2); // Return the price as a string formatted to 2 decimal places
    } else {
      console.error('Error fetching asset price:', response.statusText);
      return null;
    }
  } catch (error) {
    console.error('Error fetching asset price:', error);
    return null;
  }
};

window.convertAsset = async (fromAsset, toAsset, amount) => {
  const fromAssetUsdPrice = await getAssetPrice(fromAsset);
  const toAssetUsdPrice = toAsset === 'USDT' ? 1 : await getAssetPrice(toAsset);

  if (fromAssetUsdPrice !== null && toAssetUsdPrice !== null) {
    const usdAmount = amount * parseFloat(fromAssetUsdPrice);
    return (usdAmount / parseFloat(toAssetUsdPrice)).toFixed(2);
  }

  return null;
};

window.getAssetChartData = async symbol => {
  const endTime = Date.now(); // Current time in milliseconds
  const startTime = endTime - 7 * 24 * 60 * 60 * 1000; // 7 days ago

  const url = `https://api.binance.com/api/v3/klines?symbol=${symbol.toUpperCase()}USDT&interval=1d&startTime=${startTime}&endTime=${endTime}&limit=168`;

  try {
    const response = await fetch(url);

    if (response.ok) {
      const data = await response.json();
      return data.map(item => ({
        time: item[0], // Open time
        close: parseFloat(item[4]) // Closing price
      }));
    } else {
      console.error('Error fetching chart data:', response.statusText);
      return null;
    }
  } catch (error) {
    console.error('Error fetching chart data:', error);
    return null;
  }
};

window.convertUsdToEur = async usdAmount => {
  try {
    const response = await fetch('https://api.exchangerate-api.com/v4/latest/USD');

    if (response.ok) {
      const data = await response.json();
      const eurRate = data.rates['EUR'];

      if (eurRate) {
        return (usdAmount * eurRate).toFixed(2);
      }
    }

    return null;
  } catch (error) {
    console.error('Error fetching USD to EUR conversion rate:', error);
    return null;
  }
};

window.formatBalance = balance => {
  // Check if the balance is zero
  if (parseFloat(balance) === 0) {
    return '0.00';
  }

  // Convert to string and split at decimal
  let [whole, decimal = ''] = balance.toString().split('.');

  // Truncate after 8 decimals
  decimal = decimal.slice(0, 8);

  // Remove trailing zeros but keep minimum 2 decimals
  decimal = decimal.replace(/0+$/, '');
  if (decimal.length < 2) {
    decimal = decimal.padEnd(2, '0');
  }

  return `${whole}.${decimal}`;
};

window.formatUsdBalance = balance => {
  // Check if the balance is zero
  if (parseFloat(balance) === 0) {
    return '0.00';
  }

  // Convert to string and split at decimal
  let [whole, decimal = ''] = balance.toString().split('.');

  // Truncate after 2 decimals
  decimal = decimal.slice(0, 2);

  // Ensure exactly 2 decimals
  decimal = decimal.padEnd(2, '0');

  return `${whole}.${decimal}`;
};
